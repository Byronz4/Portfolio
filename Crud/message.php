<?php
    if(isset($_SESSION['message'])) :
?>

    <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 15px; border: none; background: #fdf6b2; color: #723b13;">
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 
    unset($_SESSION['message']);
    endif;
?>