CREATE DATABASE relacoes_internacionais;
USE relacoes_internacionais;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_nascimento DATE,
    sobre_mim TEXT,
    foto_perfil LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE teste_personalidade_relacoes_internacionais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tipo_teste VARCHAR(255),
    pergunta TEXT,
    resposta ENUM('A', 'B', 'C', 'D'),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE teste_inteligencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    logico_matematica INT,
    linguistica INT,
    espacial INT,
    musical INT,
    corporal_cinestesica INT,
    interpessoal INT,
    intrapessoal INT,
    naturalista INT,
    existencial INT,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE respostas_autoconhecimento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    pergunta TEXT,
    resposta TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE sonhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    descricao TEXT,
    acoes_atuais TEXT,
    acoes_futuras TEXT,
    area_relacoes_internacionais VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE objetivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    descricao TEXT,
    prazo DATE,
    tipo_prazo ENUM('curto', 'medio', 'longo'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE plano_acao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    area ENUM('Relacionamento Familiar', 'Estudos', 'Saúde', 'Futura Profissão', 'Religião', 'Amigos', 'Namorado(a)', 'Comunidade', 'Tempo Livre'),
    passo INT,
    descricao TEXT,
    prazo DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE profissoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    areas_atuacao TEXT,
    salario_medio DECIMAL(10,2),
    relacoes_internacionais_relevancia TEXT
);
