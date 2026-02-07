<?php

namespace App\Notifications;

use App\Models\UpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UpgradeApprovedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public UpgradeRequest $upgradeRequest
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'upgrade_approved',
            'title' => 'Upgrade Disetujui! 🎉',
            'message' => "Upgrade ke paket " . strtoupper($this->upgradeRequest->plan) . " telah disetujui.",
            'icon' => 'check-circle',
            'color' => 'green',
            'upgrade_request_id' => $this->upgradeRequest->id,
            'url' => route('client.upgrade-requests.show', $this->upgradeRequest),
        ];
    }
}
