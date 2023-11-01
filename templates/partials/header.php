<header class="bg-primary">
  <div class="container p-3 d-flex align-items-center justify-content-between">
    <a href="https://intranet.asotrauma.com.co/indexloginadmin.php">
      <img
      height="25"
      src="https://asotrauma.com.co/wp-content/uploads/2021/08/logo-asotrauma-w.svg"
      alt="logo-blanco">
    </a>
  </div>
</header>
<div class="bg-secondary text-light shadow sticky-top z-1">
  <div
  class="container nav-scroller p-1 d-flex container justify-content-between align-items-center">
    <span class="fs-5"><?=  $title ?? "Cl&iacute;nica Asotrauma" ?></span>
    <div class="d-flex gap-1">
      <?php if(
        $user->getUserType() !== \App\Enums\UserTypes::JEFE
        || $user->getAreaId() == 20
      )
        echo $this->fetch("./partials/header-links.php")
      ?>
      <span class="fs-6">
        / <?= \App\Enums\UserTypes::value(  $user->getUserType() ) ?>
      </span>
    </div>
  </div>
</div>
