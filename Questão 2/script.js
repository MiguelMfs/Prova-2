function formatarNome(nome) {
    return nome.trim().replace(/\b\w/g, char => char.toUpperCase());
}

function validarIdade(idade) {
    return idade >= 18;
}

function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, ""); // Remove tudo que não for número
    return cpf.length === 11 ? cpf : null;
}

function validarApartamento(apartamento) {
    let numero = parseInt(apartamento, 10);
    return (numero % 100 >= 0 && numero % 100 <= 10) ? numero : null;
}

function validarSenha(senha) {
    return /^\d{6}$/.test(senha);
}

// Exemplo de uso
let nome = "  joão da silva  ";
let idade = 20;
let cpf = "123.456.789-09";
let apartamento = "310";
let senha = "123456";

console.log("Nome formatado:", formatarNome(nome));
console.log("Idade válida:", validarIdade(idade));
console.log("CPF validado:", validarCPF(cpf));
console.log("Apartamento válido:", validarApartamento(apartamento));
console.log("Senha válida:", validarSenha(senha));
