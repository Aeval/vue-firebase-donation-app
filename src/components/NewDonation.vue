<template>
  <div class="backdrop" v-if="modalVisible">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Make A Donation</h5>
          <button @click="modalVisible = false" type="button" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <form>
            <div class="form-group text-left">
              <label for="name">Your Name</label>
              <input
                class="form-control"
                type="text"
                name="name"
                placeholder="e.g. 'Bob Ross', 'Pope Francis',..."
                v-model="name"
              />
              <small
                class="form-text text-muted text-left ml-1"
              >This will be what displays on that fun list you just saw!</small>
            </div>
            <div class="form-group text-left">
              <label for="email">Email Address</label>
              <input
                class="form-control"
                type="text"
                name="email"
                placeholder="generous.donator@gmail.com"
                v-model="email"
              />
              <small
                class="form-text text-muted text-left ml-1"
              >This will stay with us and no one else!</small>
            </div>
            <div class="form-group text-left">
              <label for="phone">Phone</label>
              <br />
              <input
                class="form-control"
                type="tex"
                name="phone"
                placeholder="555-555-5555"
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
                <input type="number" class="form-control" placeholder="e.g. '5', '10', '15', ..." v-model="donationAmt"/>
              </div>
              <small
                class="form-text text-muted text-left ml-1"
              >You will be redirected to Paypal's secure servers to complete the transaction.</small>
            </div>
            <div class="custom-control custom-checkbox my-1 mr-sm-2">
              <input type="checkbox" class="custom-control-input" id="customControlInline" v-model="newsletter"/>
              <label class="custom-control-label" for="customControlInline">Sign me up for the newsletter!</label>
            </div>
            <button @click.prevent="addDonation" type="submit" class="btn btn-lg btn-success my-2">Donate</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { db } from './Donations'
import { Timestamp } from '../main'

export default {
  name: "NewDonation",
  props: ["visible"],
  data() {
    return {
      modalVisible: false,
      name: '',
      email: '',
      phone: '',
      donationAmt: '',
      newsletter: Boolean,

    };
  },
  firestore: {
    
  },
  methods:{
      addDonation() {
        const form = document.querySelector('form');
        const now = new Date();

        const donation = {
          donation_name: this.name,
          donation_email: this.email,
          donation_phone: this.phone,
          donation_amount: parseInt(this.donationAmt, 10),
          newsletter: this.newsletter,
          created_at: Timestamp.fromDate(now)

        }

        db.collection('donations').add(donation)
          .then(docRef => console.log(`Doc written with ID ${docRef.id}`))
          .catch(err => console.log(err))

        form.reset();
        this.modalVisible = false;
      }
  },
  watch: {
    visible: function () {
      this.modalVisible = !this.modalVisible;
    },
  },
  created() {

  }
};
</script>

<style scoped>
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