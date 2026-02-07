<?php

namespace App\Notifications;

use App\Models\UpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UpgradeRejectedNotification extends Notification
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
            'type' => 'upgrade_rejected',
            'title' => 'Upgrade Ditolak',
            'message' => "Maaf, upgrade ke paket " . strtoupper($this->upgradeRequest->plan) . " tidak disetujui.",
            'icon' => 'x-circle',
            'color' => 'red',
            'upgrade_request_id' => $this->upgradeRequest->id,
            'url' => route('client.upgrade-requests.show', $this->upgradeRequest),
        ];
    }
}
