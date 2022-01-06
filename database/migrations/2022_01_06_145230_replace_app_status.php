<?php

use App\Models\AppCosplay;
use App\Models\AppFair;
use App\Models\AppPress;
use App\Models\AppVolunteer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceAppStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app('db')->statement("UPDATE app_cosplays SET status = '" . AppCosplay::APP_STATUS_ACCEPTED . "' WHERE status = 'Принята'");
        app('db')->statement("UPDATE app_cosplays SET status = '" . AppCosplay::APP_STATUS_REJECTED . "' WHERE status = 'Отклонена'");
        app('db')->statement("UPDATE app_cosplays SET status = '" . AppCosplay::APP_STATUS_IN_PROCESSING . "' WHERE status = 'В обработке'");
        app('db')->statement("UPDATE app_cosplays SET status = '" . AppCosplay::APP_STATUS_WAIT_USER . "' WHERE status = 'Ожидает ответа пользователя'");
        app('db')->statement("UPDATE app_cosplays SET status = '" . AppCosplay::APP_STATUS_CHANGED . "' WHERE status = 'Внесены изменения'");

        app('db')->statement("UPDATE app_fairs SET status = '" . AppFair::APP_STATUS_ACCEPTED . "' WHERE status = 'Принята'");
        app('db')->statement("UPDATE app_fairs SET status = '" . AppFair::APP_STATUS_REJECTED . "' WHERE status = 'Отклонена'");
        app('db')->statement("UPDATE app_fairs SET status = '" . AppFair::APP_STATUS_IN_PROCESSING . "' WHERE status = 'В обработке'");
        app('db')->statement("UPDATE app_fairs SET status = '" . AppFair::APP_STATUS_WAIT_USER . "' WHERE status = 'Ожидает ответа пользователя'");
        app('db')->statement("UPDATE app_fairs SET status = '" . AppFair::APP_STATUS_CHANGED . "' WHERE status = 'Внесены изменения'");

        app('db')->statement("UPDATE app_press SET status = '" . AppPress::APP_STATUS_ACCEPTED . "' WHERE status = 'Принята'");
        app('db')->statement("UPDATE app_press SET status = '" . AppPress::APP_STATUS_REJECTED . "' WHERE status = 'Отклонена'");
        app('db')->statement("UPDATE app_press SET status = '" . AppPress::APP_STATUS_IN_PROCESSING . "' WHERE status = 'В обработке'");
        app('db')->statement("UPDATE app_press SET status = '" . AppPress::APP_STATUS_WAIT_USER . "' WHERE status = 'Ожидает ответа пользователя'");
        app('db')->statement("UPDATE app_press SET status = '" . AppPress::APP_STATUS_CHANGED . "' WHERE status = 'Внесены изменения'");

        app('db')->statement("UPDATE app_volunteers SET status = '" . AppVolunteer::APP_STATUS_ACCEPTED . "' WHERE status = 'Принята'");
        app('db')->statement("UPDATE app_volunteers SET status = '" . AppVolunteer::APP_STATUS_REJECTED . "' WHERE status = 'Отклонена'");
        app('db')->statement("UPDATE app_volunteers SET status = '" . AppVolunteer::APP_STATUS_IN_PROCESSING . "' WHERE status = 'В обработке'");
        app('db')->statement("UPDATE app_volunteers SET status = '" . AppVolunteer::APP_STATUS_WAIT_USER . "' WHERE status = 'Ожидает ответа пользователя'");
        app('db')->statement("UPDATE app_volunteers SET status = '" . AppVolunteer::APP_STATUS_CHANGED . "' WHERE status = 'Внесены изменения'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app('db')->statement("UPDATE app_cosplays SET status = 'Принята' WHERE status = '" . AppCosplay::APP_STATUS_ACCEPTED . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Отклонена' WHERE status = '" . AppCosplay::APP_STATUS_REJECTED . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'В обработке' WHERE status = '" . AppCosplay::APP_STATUS_IN_PROCESSING . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Ожидает ответа пользователя' WHERE status = '" . AppCosplay::APP_STATUS_WAIT_USER . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Внесены изменения' WHERE status = '" . AppCosplay::APP_STATUS_CHANGED . "'");

        app('db')->statement("UPDATE app_fairs SET status = 'Принята' WHERE status = '" . AppFair::APP_STATUS_ACCEPTED . "'");
        app('db')->statement("UPDATE app_fairs SET status = 'Отклонена' WHERE status = '" . AppFair::APP_STATUS_REJECTED . "'");
        app('db')->statement("UPDATE app_fairs SET status = 'В обработке' WHERE status = '" . AppFair::APP_STATUS_IN_PROCESSING . "'");
        app('db')->statement("UPDATE app_fairs SET status = 'Ожидает ответа пользователя' WHERE status = '" . AppFair::APP_STATUS_WAIT_USER . "'");
        app('db')->statement("UPDATE app_fairs SET status = 'Внесены изменения' WHERE status = '" . AppFair::APP_STATUS_CHANGED . "'");

        app('db')->statement("UPDATE app_cosplays SET status = 'Принята' WHERE status = '" . AppPress::APP_STATUS_ACCEPTED . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Отклонена' WHERE status = '" . AppPress::APP_STATUS_REJECTED . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'В обработке' WHERE status = '" . AppPress::APP_STATUS_IN_PROCESSING . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Ожидает ответа пользователя' WHERE status = '" . AppPress::APP_STATUS_WAIT_USER . "'");
        app('db')->statement("UPDATE app_cosplays SET status = 'Внесены изменения' WHERE status = '" . AppPress::APP_STATUS_CHANGED . "'");

        app('db')->statement("UPDATE app_volunteers SET status = 'Принята' WHERE status = '" . AppVolunteer::APP_STATUS_ACCEPTED . "'");
        app('db')->statement("UPDATE app_volunteers SET status = 'Отклонена' WHERE status = '" . AppVolunteer::APP_STATUS_REJECTED . "'");
        app('db')->statement("UPDATE app_volunteers SET status = 'В обработке' WHERE status = '" . AppVolunteer::APP_STATUS_IN_PROCESSING . "'");
        app('db')->statement("UPDATE app_volunteers SET status = 'Ожидает ответа пользователя' WHERE status = '" . AppVolunteer::APP_STATUS_WAIT_USER . "'");
        app('db')->statement("UPDATE app_volunteers SET status = 'Внесены изменения' WHERE status = '" . AppVolunteer::APP_STATUS_CHANGED . "'");
    }
}
