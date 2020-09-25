<template>
  <div class="home container">
    <router-link to="/manage"
      ><i class="fas fa-cog float-right pt-3 text-muted"></i
    ></router-link>
    <h2 class="pt-5">Donate Today!</h2>
    <h4>
      <small class="text-muted"
        >We always appreciate your help and you won't believe the difference you
        make!</small
      >
    </h4>
    <img
      class="main-logo my-2"
      src="../assets/donate-hand2.png"
      alt="Donation icon"
    />
    <Donations />
    <button @click="showModal" class="btn btn-lg btn-success my-4">
      Make A Difference!
    </button>
    <NewDonation :visible="this.modalVisible" />
  </div>
</template>

<script>
// @ is an alias to /src
import Donations from "@/components/Donations.vue";
import NewDonation from "@/components/NewDonation.vue";

export default {
  name: "Home",
  components: {
    Donations,
    NewDonation,
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

<style>
.main-logo {
  height: 150px;
  width: 150px;
}

.home {
  background-color: #eeeeee;
  height: 50em;
  box-shadow: #3d3d3d 5px 5px 15px;
}

body {
  background: no-repeat
    linear-gradient(to bottom right, #9a1750, #ee4c7c, #e3afbc);
  background-size: 100%;
  height: 100vh;
}
</style>
