<?php

namespace App\Http\Controllers;

use App\Models\AppVolunteer;
use App\Models\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Mail;

class AppVolunteerController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'type_id',
        'status',
        'created_at',
        'updated_at',
        'nickname',
        'skills',
        'birthday',
        'city',
        'phone',
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        $query = AppVolunteer::select('*')
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::user()->id);
        }

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('skills', 'LIKE', "%$keyword%")
                    ->orWhere('nickname', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%");
            });
        }

        $applications = $query->paginate(5);

        return view('pages.volunteer.index', ['applications' => $applications, 'sort' => $this->prepareSort($request, $this->sortFields)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.volunteer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request,[
            'photo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => '',
            'skills' => 'required|string',
            'difficulties' => 'nullable|string',
            'experience' => 'nullable|string',
        ]);
        //store in database
        $volunteer = new AppVolunteer();
        $volunteer->surname= $request->get('surname');
        $volunteer->first_name = $request->get('first_name');
        if($request->get('nickname') == null){
            $volunteer->nickname = $request->get('surname') .' '. $request->get('first_name');
        }else {
            $volunteer->nickname = $request->get('nickname');
        }
        if($request['photo']) {
            $imageFile = $request['photo'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('uploads/volunteers'), $imageName);
            $imagePath = 'uploads/volunteers/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $volunteer->photo= $imagePath;
        }
        $volunteer->birthday = $request->get('birthday');
        $volunteer->phone = $request->get('phone');
        $volunteer->city = $request->get('city');
        $volunteer->social_links = json_encode($request['social_links']);
        $volunteer->skills = $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');
        $volunteer->user_id = Auth::user()->id;
        $volunteer->status = 'В обработке';
        $volunteer->save();

        $user = User::find( Auth::user()->id);
        $mail['email'] = $user->email;
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $volunteer->nickname;
        $mail['page'] = "/volunteer/ $volunteer->id";
        Mail::send('mails.application',  $mail , function($message) use ( $mail ) {
            $message->to( $mail['email']);
            $message->subject('Ваша заявка успешно отправлена');
        });
        return redirect('volunteer')->with('success', "Ваша заявка успешно отправлена.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $volunteer= AppVolunteer::where('id', $id)->first();
        $social_links =  json_decode( $volunteer->social_links);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'volunteer')
            ->where('app_id', $volunteer->id)->get();
        return view('pages.volunteer.show', compact('volunteer', 'social_links', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $volunteer = AppVolunteer::where('id', $id)->first();
        $social_links =  json_decode($volunteer->social_links);
        return view('pages.volunteer.edit', compact('volunteer', 'social_links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        $this->validate($request,[
            'photo'=>'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'skills' => 'required|string',
            'difficulties' => 'nullable|string',
            'experience' => 'nullable|string',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => '',
        ]);
        //store in database
        $volunteer = AppVolunteer::where('id', $id)->first();
        if($request['photo']) {
            $imageFile = $request['photo'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('uploads/volunteers'), $imageName);
            $imagePath = 'uploads/volunteers/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $volunteer->photo= $imagePath;
        }
        $volunteer->surname= $request->get('surname');
        $volunteer->first_name = $request->get('first_name');
        $volunteer->nickname = $request->get('nickname');
        $volunteer->birthday = $request->get('birthday');
        $volunteer->phone = $request->get('phone');
        $volunteer->city = $request->get('city');
        $volunteer->social_links = json_encode($request['social_links']);
        $volunteer->skills= $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');

        if($volunteer->status != $request->get('status')) {
            $user =  User::where('id', $volunteer->user_id)->first();
            $mail['email'] = $user->email;
            $mail['nickname'] = $user->profile->nickname;
            $mail['title'] = $volunteer->nickname;
            $mail['page'] = '/volunteer/'.  $volunteer->id;
            $mail['status'] = $request->get('status');
            Mail::send('mails.status',  $mail , function($message) use ( $mail ){
                $message->to( $mail['email']);
                $message->subject('Изминение статуса завки');
            });
        }
        if($request->get('status')) {
            if (Auth::user()->isAdmin()) {
                $volunteer->status = $request->get('status');
            }
        }
        $volunteer->save();
        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest.mail@gmail.com';
            $mail['title'] = $volunteer->title;
            $mail['page'] = '/volunteer/'. $volunteer->id;
            Mail::send('mails.edit', $mail, function ($message) use ($mail) {
                $message->to($mail['email']);
                $message->subject('Заявка ' .$mail['title'] . ' изменена');
            });
        }
        return redirect('volunteer')->with('success', "Ваша заявка успешно изменена.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
