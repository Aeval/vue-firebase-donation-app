<template>
  <div class="home container-fluid">
    <router-link to="/"
      ><i class="fas fa-home float-right pt-3 text-muted"></i
    ></router-link>
    <h2 class="pt-5">Manage Your Donations</h2>
    <h4 class="mb-5">
      <small class="text-muted">Track, edit or delete donation records</small>
    </h4>
    <ManagedDonations />
  </div>
</template>

<script>
// @ is an alias to /src
import ManagedDonations from "@/components/ManagedDonations.vue";

export default {
  name: "Home",
  components: {
    ManagedDonations,
  },
  data() {
    return {
      modalVisible: false,
    };
  },
  methods: {
    showModal() {
      this.modalVisible = !this.modalVisible;
    },
  },
};
</script>

<style scoped>
.main-logo {
  height: 150px;
  width: 150px;
}

.home {
  background-color: #eeeeee;
  height: 50em;
  width: 90%;
  box-shadow: #3d3d3d 5px 5px 15px;
}

body {
  background: no-repeat
    linear-gradient(to bottom right, #9a1750, #ee4c7c, #e3afbc);
  background-size: 100%;
  height: 100vh;
}
</style>

