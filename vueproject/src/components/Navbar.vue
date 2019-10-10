<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Vue</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
              aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="home" class="nav-link">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="add" class="nav-link">Add Product</router-link>
          </li>
          <li class="nav-item">
            <router-link to="list" class="nav-link">Product Basket</router-link>
          </li>
          <!--          <li class="nav-item dropdown">-->
          <!--            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"-->
          <!--               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
          <!--              Dropdown link-->
          <!--            </a>-->
          <!--            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
          <!--              <a class="dropdown-item" href="#">More</a>-->
          <!--              <a class="dropdown-item" href="#">About</a>-->
          <!--              <a class="dropdown-item" href="#">Action</a>-->
          <!--            </div>-->
          <!--          </li>-->
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>

</style>
