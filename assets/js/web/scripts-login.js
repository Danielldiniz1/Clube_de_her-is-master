import HttpClientBase from '../../class/HttpClientBase.js';

console.log("ola");


const form = document.getElementById("formLogin");
const emailInput = document.getElementById("email");
const senhaInput = document.getElementById("password");
const result = document.getElementById("result")

const api = new HttpClientBase("http://localhost/Clube_de_her-is-master/api/users/"); 


form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const email = emailInput.value.trim();
    const password = senhaInput.value;

    const formdata = new FormData();
    formdata.append("email", email);
    formdata.append("password", password);

    try {
        const response = await api.post("login", formdata);

        if (response.type === "success") {
            localStorage.setItem("token", response.data.user.token);
            localStorage.setItem("user", JSON.stringify(response.data.user.id));
            localStorage.setItem("dataUser", JSON.stringify(response.data.user));



            let url = window.location.href;
            let urlPrivate = url.slice(0, -5) + 'app';
            window.location.href = urlPrivate;

        } else {
            result.textContent =  response.message
        }
    } catch (error) {
        result.textContent = "Credenciais inválidas";   
        
    }
});
