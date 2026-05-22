<?php

use Flux\Flux;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

return new #[Layout('layouts::guest')] class () extends Component {
    #[Validate(['required', 'email'])]
    public string $email = '';

    public function sendResetLink(): void
    {
        $validated = $this->validate();

        $status = Password::sendResetLink($validated);

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        Flux::toast(__($status), variant: 'success');
    }
};
