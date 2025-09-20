<?php

use App\Jobs\ProcessEmailCampaign;
use App\Jobs\ProcessSmsCampaign;
use App\Models\EmailCampaign;
use App\Models\SmsCampaign;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
  $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
  $smsCampaigns = SmsCampaign::where('status', 'Pending')->whereDate('schedule_time', date('Y-m-d'))->get();
  foreach ($smsCampaigns as $smsCampaign) {
    $schedule->job(new ProcessSmsCampaign($smsCampaign))->when(function () use ($smsCampaign) {
      $now = date('Y-m-d H:i:s');
      if (strtotime($smsCampaign->schedule_time) < strtotime($now)) {
        $smsCampaign->update(['status' => 'Processing']);
        return true;
      }
    });
  }

  $emailCampaigns = EmailCampaign::where('status', 'Pending')->whereDate('schedule_time', date('Y-m-d'))->get();
  foreach ($emailCampaigns as $emailCampaign) {
    $schedule->job(new ProcessEmailCampaign($emailCampaign))->when(function () use ($emailCampaign) {
      $now = date('Y-m-d H:i:s');
      if (strtotime($emailCampaign->schedule_time) < strtotime($now)) {
        $emailCampaign->update(['status' => 'Processing']);
        return true;
      }
    });
  }
})->everyMinute();
