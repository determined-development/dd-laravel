<?php

use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Component;

return new #[Layout('layouts::guest')] class () extends Component {
    public function mount(): void
    {
        if (auth()->user()->hasVerifiedEmail()) {
            $this->redirect(route('dashboard'));
        }
    }

    public function sendVerificationNotification(): void
    {
        if (auth()->user()->hasVerifiedEmail()) {
            $this->redirect(route('dashboard'));

            return;
        }

        auth()->user()->sendEmailVerificationNotification();

        Flux::toast(trans('auth.verify_email.sent'), variant: 'success');
    }
};
