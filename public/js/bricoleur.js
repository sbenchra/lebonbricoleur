var app = new Vue({
	el: '#app',
	data: {
		success: false,
		metiers: [],

	},

	methods: {
		updateServices() {
			axios.post('/metiers', {
				metiers : $('#pre-selected-options').val()
			})
			.then(function (response) {
				app.success = response.data.message;
				app.fetchData();
				app2.fetchAnnonces();
				console.log(response);
			})
			.catch(function (error) {
				console.log(error);	
			});
		},

		fetchData() {
			axios.get('/metiers')
			.then(function (response) {
				app.metiers = response.data[0].metiers
				console.log(response)
			}).catch(function(error) {
				console.log(error);
			});
		},

		populateSelect() {
			var m  = []
			for (var i = 0; i < this.metiers.length ; i++) {
				m[i] = this.metiers[i].name;
			}
			console.log(m);
			$('#pre-selected-options').multiSelect('select', m);
		}, 

		houseKeeping() {
			this.success = false;
			this.populateSelect();
		},

		
	},
	
	mounted: function() {
		this.fetchData();
		//this.fetchAnnonces();
	}
	
});

var app2 = new Vue({
	el: '#app-2',
	data: {
		annonces: [],
		users: [],
		clickedAnnonce: null
	},

	methods: {
		fetchAnnonces() {
			axios.get('/annonces')
			.then(function (response) {
				this.annonces = response.data
				console.log(response)
			}.bind(this)).catch(function(error) {
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

		prepareModal(annonce) {
			this.clickedAnnonce = annonce;
			$('#interested-modal .modal-header .modal-title').text(annonce.titre);
			$('#budget_suggere').val(annonce.budget_initial);
			$('#date_limite').val(annonce.date_limite);
			$('#annonce_id').val(annonce.id);
		}
	},

	mounted: function() {
		this.fetchUsers();
		this.fetchAnnonces();
		setInterval(function () {
			this.fetchUsers();
			this.fetchAnnonces();
		}.bind(this), 5000); 
	}
});


var app3 = new Vue({
	el: '#app-3',

	data: {
		budget: '',
		dateLimite: '',
		user_id: '',
		annonce_id: '',
		success: false
	} ,


	methods: {
		imIn() {
			axios.post('/annonce-user', {
				budget: $('#budget_suggere').val(),
				date_limite: $('#date_limite').val(),
				annonce_id: $('#annonce_id').val()
			})
			.then(function (response) {
				app3.success = response.data.message;
				console.log(response);
			})
			.catch(function (error) {
				console.log(error);	
			});
		}, 

		houseKeeping() {
			this.success = false;
			//this.populateSelect();
		},
		
	}
});