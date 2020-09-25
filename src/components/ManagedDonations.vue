<template>
  <div>
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Donation Amt</th>
        <th>Newsletter?</th>
        <th>Edit</th>
        <th>Delete</th>
      </thead>
      <tbody>
        <tr v-for="donation in donations" :key="donation.id">
          <td>{{ donation.id }}</td>
          <td>{{ donation.donation_name }}</td>
          <td>{{ donation.donation_email }}</td>
          <td>{{ donation.donation_phone }}</td>
          <td>{{ donation.donation_amount }}</td>
          <!-- Check for newletter sign-up -->
          <td v-if="donation.newsletter">
            <i class="fas fa-newspaper"></i>
          </td>
          <td v-else></td>
          <!-- End newsletter block -->
          <td>
            <i @click="showEditModal(donation)" class="fas fa-edit"></i>
          </td>
          <td>
            <i @click="deleteDonation(donation)" class="fas fa-trash"></i>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Edit Modal Start -->
    <div class="backdrop" v-if="modalVisible">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Donation</h5>
            <button @click="modalVisible = false" type="button" class="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
            <form>
              <div class="form-group text-left">
                <label for="name">Name</label>
                <input
                  class="form-control"
                  type="text"
                  name="name"
                  v-model="name"
                />
              </div>
              <div class="form-group text-left">
                <label for="email">Email Address</label>
                <input
                  class="form-control"
                  type="text"
                  name="email"
                  v-model="email"
                />
              </div>
              <div class="form-group text-left">
                <label for="phone">Phone</label>
                <br />
                <input
                  class="form-control"
                  type="tel"
                  name="phone"
                  pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                  v-model="phone"
                />
              </div>
              <div class="form-group text-left">
                <label for="amount">Donation Amount</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">$</div>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    v-model="donationAmt"
                  />
                </div>
              </div>
              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="customControlInline"
                  v-model="newsletter"
                />
                <label class="custom-control-label" for="customControlInline"
                  >Enroll in Newsletter?</label
                >
              </div>
              <button
                @click.prevent="editDonation"
                type="submit"
                class="btn btn-lg btn-success my-2"
              >
                Confirm
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { db } from "./Donations";

export default {
  name: "Donations",
  data() {
    return {
      donations: [],
      modalVisible: false,
      donationID: "",
      name: "",
      email: "",
      phone: "",
      donationAmt: "",
      newsletter: Boolean,
    };
  },
  firebase: {
    donations: db.collection("donations"),
  },
  methods: {
    showEditModal(donation) {
      this.donationID = donation.id;
      this.name = donation.donation_name;
      this.email = donation.donation_email;
      this.phone = donation.donation_phone;
      this.donationAmt = donation.donation_amount;
      this.newsletter = donation.newsletter;
      this.modalVisible = true;
    },
    deleteDonation(donation) {
      db.collection("donations")
        .doc(donation.id)
        .delete()
        .then(function () {
          console.log("Document successfully deleted!");
        })
        .catch(function (error) {
          console.error("Error removing document: ", error);
        });
    },
    editDonation() {
      const form = document.querySelector("form");

      var donationDoc = db.collection("donations").doc(this.donationID);

      donationDoc.set(
        {
          donation_name: this.name,
          donation_email: this.email,
          donation_phone: this.phone,
          donation_amount: this.donationAmt,
          newsletter: this.newsletter,
        },
        { merge: true }
      );

      form.reset();
      this.modalVisible = false;
    },
  },
  created() {
    this.$bind(
      "donations",
      db.collection("donations").orderBy("created_at", "desc")
    )
      .then((donations) => (this.donations = donations))
      .catch((err) => console.log(err));
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}

.donation-row {
  background-color: #42b983;
  width: 75%;
  box-shadow: rgba(70, 70, 70, 0.933) 2px 2px 1px;
}

.donation-row:hover {
  box-shadow: rgba(54, 54, 54, 0.933) 5px 5px 5px;
  background-color: #4cca92;
}

p {
  color: aliceblue;
  font-size: 1.5em;
}

.donations-list {
  overflow-y: scroll;
  overflow-x: hidden;
  height: 350px;
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}

.donations-list::-webkit-scrollbar {
  display: none;
}

.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background-color: rgb(0, 0, 0, 0.6);
}

.modal-dialog {
  top: 15vh;
}
</style>