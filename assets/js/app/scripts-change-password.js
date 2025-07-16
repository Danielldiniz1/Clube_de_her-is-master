const showModal = document.getElementById("change");     // Botão que abre o modal
const modal = document.getElementById("modal");          // Modal
const closeModal = document.getElementById("cancel");    // Botão cancelar
const form = modal.querySelector("form");   

console.log("oi");

const currentPasswordInput = document.getElementById("currentPassword");
const newPasswordInput = document.getElementById("newPassword");
const confirmPasswordInput = document.getElementById("confirmPassword");

// Criar campo para mostrar resultado
let resultBox = document.createElement("div");
resultBox.id = "password-result";
resultBox.style.marginTop = "10px";
form.appendChild(resultBox);

// Pega usuário e token
const user = JSON.parse(localStorage.getItem("dataUser"));
const token = localStorage.getItem("token");
console.log("Token JWT:", token);

// Abre o modal
showModal.addEventListener("click", () => {
  modal.style.display = "flex";
});

// Fecha o modal
closeModal.addEventListener("click", () => {
  modal.style.display = "none";
  resultBox.textContent = "";
});

// Lida com envio do formulário
form.addEventListener("submit", async (event) => {
  event.preventDefault();

  const currentPassword = currentPasswordInput.value;
  const newPassword = newPasswordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  const formData = new FormData();
  formData.append("password", currentPassword);
  formData.append("newPassword", newPassword);
  formData.append("confirmNewPassword", confirmPassword);

  const myHeaders = new Headers();
  myHeaders.append("token", token);
  myHeaders.append("Authorization", `Bearer ${token}`);

  const requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: formData,
    redirect: "follow"
  };

  try {
    const response = await fetch("http://localhost/bookstore/mvc-project-manha-main/api/users/set-password", requestOptions);
    const data = await response.json();
    console.log("📄 Resposta da API:", data);

    if (data.type === "success") {
      resultBox.textContent = "Senha alterada com sucesso!";
      resultBox.style.color = "green";
      setTimeout(() => {
        modal.style.display = "none";
        resultBox.textContent = "";
        form.reset();
      }, 2000);
    } else {
      resultBox.textContent = data.message || "Erro ao atualizar senha.";
      resultBox.style.color = "red";
    }
  } catch (error) {
    console.error("Erro:", error);
    resultBox.textContent = "Erro ao atualizar senha.";
    resultBox.style.color = "red";}
});