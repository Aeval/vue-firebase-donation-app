<template>
	<div>
		<ul class="donations-list">
			<li class="container mt-2" v-bind:key="donation.id" v-for="donation in donations">
				<div v-bind:style="[donation.donation_amount > 100 ? { 'background-color': '#D4AF37' } : { 'background-color': '#42b983' }]" class="donation-row row mx-auto my-1 rounded hover">
					<div class="col-2 my-2 text-left">
						<img src="../assets/party-popper.png" alt="party icon" height="50px" width="50px" />
					</div>
					<p class="col my-auto">{{ donation.donation_name }}</p>
					<p class="col my-auto">${{ donation.donation_amount }}</p>
				</div>
			</li>
		</ul>
	</div>
</template>

<script>
	import firebase from 'firebase';

	export const db = firebase.initializeApp({ projectId: 'vue-donation', apiKey: ' AIzaSyAVJwGwkiy0lStur9TgIqA2GxgR-VuixQs' }).firestore();

	export default {
		name: 'Donations',
		data() {
			return {
				donations: [],
			};
		},
		firebase: {
			donations: db.collection('donations'),
		},
		created() {
			this.$bind('donations', db.collection('donations').orderBy('created_at', 'desc'))
				.then(donations => (this.donations = donations))
				.catch(err => console.log(err));
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
</style>
