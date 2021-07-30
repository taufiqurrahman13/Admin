<?php
$success     = $this->session->flashdata('success');
$error          = $this->session->flashdata('error');
$warning    = $this->session->flashdata('warning');

if ($success) {
    $alert_status   = 'alert-success';
    $status             = 'Success';
    $message        = $success;
}

if ($error) {
    $alert_status   = 'alert-danger';
    $status             = 'Error';
    $message        = $error;
}

if ($warning) {
    $alert_status   = 'alert-warning';
    $status             = 'Warning';
    $message        = $warning;
}
?>

<?php if ($error || $warning) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert flash-data alert-dismissible fade show " role="alert" data-flashdata=" <?= $message ?>" data-status="<?= $status ?>">
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($success) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert <?= $alert_status ?> alert-dismissible fade show " role="alert">
                <strong><?= $status ?></strong> <?= $message ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>