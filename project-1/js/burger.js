document.addEventListener('DOMContentLoaded', () => {
	'use strict'
	document.querySelector('.order__form-button').addEventListener('click', e => {
		e.preventDefault()
		let formErrMsg = document.querySelector('#formErrMsg')
		let form = document.querySelector('#order-form')
		let formData = new FormData(form)
		let valid = true
		let init = {
			method: 'post',
			body: formData
		}
		if (form['name'].value === '') {
			document.querySelector('#name').innerHTML = 'Напишите своё имя'
			valid = false
		} else {
			document.querySelector('#name').innerHTML = ''
		}
		if (form['email'].value === '') {
			document.querySelector('#email').innerHTML = 'Напишите свой email'
			valid = false
		} else {
			document.querySelector('#email').innerHTML = ''
		}
		if (form['phone'].value === '') {
			document.querySelector('#phone').innerHTML = 'Напишите свой телефон'
			valid = false
		} else {
			document.querySelector('#phone').innerHTML = ''
		}
		if (form['street'].value === '') {
			document.querySelector('#street').innerHTML = 'Напишите название улицы'
			valid = false
		} else {
			document.querySelector('#street').innerHTML = ''
		}
		if (form['home'].value === '') {
			document.querySelector('#home').innerHTML = 'Напишите номер дома'
			valid = false
		} else {
			document.querySelector('#home').innerHTML = ''
		}
		if (form['payment'].value === '') {
			document.querySelector('#payment').innerHTML = 'Выберите способ оплаты'
			valid = false
		} else {
			document.querySelector('#payment').innerHTML = ''
		}
		if (valid) {
			fetch('php/order.php', init)
				.then(response => {
					if (response.ok) {
						return response.text()
					} else throw new Error('Не удалось получить ответ от сервера')
				})
				.then(data => {
					form.reset()
					document.querySelector('#form-success').innerHTML = '<span style="color:green;">Заказ оформлеен</span>'
					console.log(data)
				})
				.catch(error => document.querySelector('#form-success').innerHTML = 'Ошибка: ' + error)
		}
	})
})