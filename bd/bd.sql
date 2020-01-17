Create table usuario (
matricula Int NOT NULL,
nome Varchar(30),
sobrenome Varchar(30),
email Varchar(30),
senha Varchar(40),
nivel INT(1) UNSIGNED NOT NULL DEFAULT 1, #Difere usuario padrao do adm. 1 padrao 2 adm
credito INT(100) UNSIGNED DEFAULT 0,
tipo Varchar(1) DEFAULT 'A',
Primary Key (matricula),
UNIQUE KEY matricula (matricula),
KEY nivel (nivel));

CREATE TABLE boleto (
pago Varchar(30),
valor Int(100),
boleto Int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (boleto),
usuario_mat Int NOT NULL,
INDEX (usuario_mat),
FOREIGN KEY (usuario_mat) REFERENCES usuario(matricula));



