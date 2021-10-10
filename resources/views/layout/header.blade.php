<div class="az-header">
  <div class="container">
    <div class="az-header-left">
      <a href="user" class="az-logo"><span></span> Accounts Master</a>
    </div><!-- az-header-left -->

    <div class="az-header-right">
      <div class="az-profile-menu font-weight-bolder">
        Muhammad Rizaldy Idil
      </div><!-- az-header-notification -->
      <div class="dropdown az-profile-menu">
        <a href="" class="az-img-user"><img src="../img/faces/face1.jpg" alt=""></a>
        <div class="dropdown-menu">
          <div class="az-dropdown-header d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
          </div>
          <div class="az-header-profile">
            <div class="az-img-user">
              <img src="../img/faces/face1.jpg" alt="">
            </div><!-- az-img-user -->
            <h6>Muhammad Rizaldy Idil</h6>
            <span>Premium Member</span>
          </div><!-- az-header-profile -->

          <a href="./profil" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
          <a href="./category" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> categories</a>
          <a href="#" class="dropdown-item logout"><i class="typcn typcn-power-outline"></i> Log Out</a>
          <form id="logout" method="post" action="{{url('logout')}}">
            @csrf
            <input type="hidden" name="logout" value="{Auth::user()->id}">
          </form>
        </div><!-- dropdown-menu -->
      </div>
    </div><!-- az-header-right -->
  </div><!-- container -->
</div><!-- az-header -->