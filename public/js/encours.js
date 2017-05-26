var app = new Vue({
	el: "#app",

	data: {
		annonces: [],
		annonces_done: [],
		//users: [],
	}, 


	methods: {
		fetchAnnonces() {
			axios.get('/dashboard/api/pending_client')
				.then(function (response) {
					app.annonces = response.data;
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		fetchAnnoncesDone() {
			axios.get('/dashboard/api/done_client')
				.then(function (response) {
					app.annonces_done = response.data;
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
		},
		fetchUsers() {
			axios.get('/users')
			.then(function (response) {
				this.users = response.data
				console.log(response)
			}.bind(this)).catch(function(error) {
				console.log(error);
			});
		},
		timeSince(date) {

				var seconds = Math.floor(((new Date() - Date.parse(date)))/ 1000);

				var interval = Math.floor(seconds / 31536000);

				if (interval > 1) {
					return interval + " années";
				}
				interval = Math.floor(seconds / 2592000);
				if (interval > 1) {
					return interval + " mois";
				}
				interval = Math.floor(seconds / 86400);
				if (interval > 1) {
					return interval + " jours";
				}
				interval = Math.floor(seconds / 3600);
				if (interval > 1) {
					return interval + " heures";
				}
				interval = Math.floor(seconds / 60);
				if (interval > 1) {
					return interval + " minutes";
				}
				return Math.floor(seconds) + " secondes";
			},
	},

	mounted : function() {
		//this.fetchUsers();
		this.fetchAnnonces();
		this.fetchAnnoncesDone();
	}
});