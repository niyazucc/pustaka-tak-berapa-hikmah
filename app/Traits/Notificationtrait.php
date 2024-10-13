<?php

namespace App\Traits;

use Filament\Notifications\Notification;

trait NotificationTrait
{
    protected function popupNotification(string $title = null, string $body = null, $state = 'success')
    {
        Notification::make()
            ->title($title ?? $this->notificationTile())
            ->body($body ?? $this->notificationBody())
            ->success()
            ->color($state)
            ->seconds(3)
            ->send();
    }

    protected function infoNotification(string $title = null, string $body = null)
    {
        Notification::make()
            ->title($title ?? $this->notificationTile())
            ->body($body ?? $this->notificationBody())
            ->color('info')
            ->info()
            ->seconds(3)
            ->send();
    }

    protected function warningNotification(string $title = null, string $body = null)
    {
        Notification::make()
            ->title($title ?? $this->notificationTile())
            ->body($body ?? $this->notificationBody())
            ->color('warning')
            ->warning()
            ->seconds(3)
            ->send();
    }

    protected function dangerNotification(string $title = null, string $body = null)
    {
        Notification::make()
            ->title($title ?? $this->notificationTile())
            ->body($body ?? $this->notificationBody())
            ->color('danger')
            ->danger()
            ->seconds(3)
            ->send();
    }

    protected function notificationTitle()
    {
        return null;
    }

    protected function notificationBody()
    {
        return null;
    }
}
