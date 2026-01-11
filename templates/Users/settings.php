<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <h3 class="card-title text-primary mb-0 fw-bold">
                        <i class="bi bi-person-gear me-2"></i> Edit Profile
                    </h3>
                </div>
                <div class="card-body p-4">
                    <?= $this->Form->create($user, ['class' => 'profile-form']) ?>
                        
                        <div class="mb-4 text-center">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-fill text-secondary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-dark fw-bold"><?= h($user->email) ?></h5>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark fw-bold small">Username</label>
                            <?= $this->Form->control('username', [
                                'label' => false,
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark fw-bold small">Change Password</label>
                            <?= $this->Form->control('password', [
                                'label' => false,
                                'class' => 'form-control',
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
    .form-control:focus {
        border-color: #7C3AED;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }
    .text-primary { color: #7C3AED !important; }
    
    .btn-gold {
        background: linear-gradient(135deg, #7C3AED 0%, #8B5CF6 100%);
        color: #ffffff;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
        border-radius: 8px;
    }
    .btn-gold:hover {
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.3);
        transform: translateY(-2px);
        color: #ffffff;
    }
</style>
