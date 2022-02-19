function login_true(title)
{
	let timerInterval
	Swal.fire({
		title: title,
		imageUrl: 'assets/login/img/logo.png',
		imageWidth: 200,
		imageHeight: 200,
		imageAlt: 'Custom image',
		html: 'di alihkan dalam waktu <b></b> milliseconds.',
		timer: 2000,
		timerProgressBar: true,
		willOpen: () => {
			Swal.showLoading()
			timerInterval = setInterval(() => {
				const content = Swal.getContent()
				if (content) {
					const b = content.querySelector('b')
					if (b) {
						b.textContent = Swal.getTimerLeft()
					}
				}
			}, 100)
		},
		onClose: () => {
			clearInterval(timerInterval)
		}
	}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			 window.location.href = "welcome/role";
		}
	})
}
function login_false(title)
{
	Swal.fire({
		title: title,
		text: 'E-mail Dan password Tidak Terdaftar',
		imageUrl: 'assets/login/img/logo.png',
		imageWidth: 200,
		imageHeight: 200,
		imageAlt: 'Custom image',
	})
}

function success(pesan) {
	Swal.fire({
		"icon":"success",
		"title": "Sukses",
		"text": "Data Berhasil disimpan",
		"type": "success"
	}).then((result) => {
		if (result.value) {
			reload_ajax();
		}
	});
}