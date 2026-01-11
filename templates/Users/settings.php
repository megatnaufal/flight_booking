<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark border-secondary shadow-lg">
                <div class="card-header border-secondary p-4">
                    <h3 class="card-title text-gold mb-0">
                        <i class="bi bi-person-gear me-2"></i> Edit Profile
                    </h3>
                </div>
                <div class="card-body p-4">
                    <?= $this->Form->create($user, ['class' => 'profile-form']) ?>
                        
                        <div class="mb-4 text-center">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle border border-secondary bg-black mb-3" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-fill text-secondary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-white"><?= h($user->email) ?></h5>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small">Username</label>
                            <?= $this->Form->control('username', [
                                'label' => false,
                                'class' => 'form-control form-control-dark',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-gold small">Change Password</label>
                            <?= $this->Form->control('password', [
                                'label' => false,
                                'class' => 'form-control form-control-dark',
                                'required' => false,
                                'value' => '',
                                'placeholder' => 'Leave blank to keep current password'
                            ]) ?>
                            <div class="form-text text-secondary small">Only enter a password if you want to change it.</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="<?= $this->Url->build('/') ?>" class="text-secondary text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Back to Home
                            </a>
                            <button type="submit" class="btn btn-gold px-4">Update Profile</button>
                        </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-dark {
        background: #121212;
        border: 1px solid #333;
        color: #ecf0f1;
    }
    .form-control-dark:focus {
        background: #1a1a1a;
        border-color: #FFD300;
        color: #ecf0f1;
        box-shadow: 0 0 10px rgba(255, 211, 0, 0.2);
    }
    .btn-gold {
        background: linear-gradient(180deg, #FFD300 0%, #c9a600 100%);
        color: #0a0a0a;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-gold:hover {
        box-shadow: 0 0 20px rgba(255, 211, 0, 0.5);
        transform: translateY(-2px);
    }
    .text-gold {
        color: #FFD300;
    }
</style>
