<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers\EducationExperienceRelationManager;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class EducationExperienceRelationManagerTest extends TestCase
{
    public function test_create_experience()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(EducationExperienceRelationManager::class,[
            'ownerRecord' => $user,
            'pageClass' => EditUser::class
        ])->assertTableActionVisible('create');

        //throws Call to undefined method Illuminate\Database\Eloquent\Relations\HasOneThrough::save()
        Livewire::test(EducationExperienceRelationManager::class,[
            'ownerRecord' => $user,
            'pageClass' => EditUser::class
        ])->callTableAction('create', data: [
            'experience' => 'Test Experience'
        ])->assertHasNoTableActionErrors();
    }
}
