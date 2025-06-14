window.addEventListener('load', () => {
    const form = document.querySelector('#formulario')
    const nombre = document.getElementById('nombre')
    const usuario = document.getElementById('usuario')
    const email = document.getElementById('email')
    const pass = document.getElementById('pass')

    form.addEventListener('submit', (e) => {
        e.preventDefault()
        const isValid = validaCampos()
        if (isValid) {
            form.submit() // Permite el envío del formulario
        }
    })

    const validaCampos = () => {
        let valid = true; // Variable para verificar la validez

        // Capturar los valores ingresados por el usuario
        const usuarioValor = usuario.value.trim()
        const emailValor = email.value.trim()
        const passValor = pass.value.trim()
        const nomValor = nombre.value.trim()

        // Validando campo usuario
        if (!usuarioValor) {
            validaFalla(usuario, 'Campo vacío')
            valid = false; // Campo inválido
        } else {
            validaOk(usuario)
        }

        // Validando campo email
        if (!emailValor) {
            validaFalla(email, 'Campo vacío')
            valid = false; // Campo inválido
        } else if (!validaEmail(emailValor)) {
            validaFalla(email, 'El e-mail no es válido')
            valid = false; // Campo inválido
        } else {
            validaOk(email)
        }

        // Validando campo contraseña
        const er = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,18}$/
        if (!passValor) {
            validaFalla(pass, 'Campo vacío')
            valid = false; // Campo inválido
        } else if (passValor.length < 8) {
            validaFalla(pass, 'Debe tener 8 caracteres como mínimo.')
            valid = false; // Campo inválido
        } else if (!passValor.match(er)) {
            validaFalla(pass, 'Debe tener al menos una mayúscula, una minúscula y un número.')
            valid = false; // Campo inválido
        } else {
            validaOk(pass)
        }

        // Validando campo nombre
        if (!nomValor) {
            validaFalla(nombre, 'Campo vacío')
            valid = false; // Campo inválido
        } else {
            validaOk(nombre)
        }

        return valid; // Retorna si todos los campos son válidos
    }

    const validaFalla = (input, msje) => {
        const formControl = input.parentElement
        const aviso = formControl.querySelector('p')
        aviso.innerText = msje
        formControl.className = 'form-control falla'
    }

    const validaOk = (input) => {
        const formControl = input.parentElement
        formControl.className = 'form-control ok'
    }

    const validaEmail = (email) => {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }
})