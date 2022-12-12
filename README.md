# Blue_saude
Trabalho feito durante a discilplina de Sistemas para Internet II

Enunciado: SISTEMA PARA PLANO DE SAÚDE (SIMPLIFICADO)

CADASTRO de MÉDICOs Nome, Endereço, Telefone, E-mail, Especialidade, CRM, … Criar e Alterar MÉDICOS

CADASTRO de LABORATÓRIOs Nome, Endereço, Telefone, E-mail, Tipos de Exame, CNPJ, … Criar e Alterar LABORATÓRIOS

CADASTRO de PACIENTEs Nome, Endereço, Telefone, E-mail, Gênero, Idade, CPF, … Criar e Alterar PACIENTES

Outros CADASTROs Criar e Alterar Registros de CONSULTAS e EXAMES Histórico de CONSULTAS (ex.: Data, Médico, Paciente, Receita, Observações) Histórico de EXAMES (ex.: Data, Laboratório, Paciente, TipoExame, Resultado)

ADMIN CADASTRA Pacientes, Laboratórios e Médicos CUIDADO: Não Replicar Cadastros (ex.: Médicos com mesmo nome)

MÉDICOs ALTERA seu Cadastro CADASTRA Consultas VÊ HISTÓRICO de Consultas de Paciente

LABORATÓRIOs ALTERA seu Cadastro CADASTRA Exames VÊ HISTÓRICO de Exames de Paciente

PACIENTEs VÊ HISTÓRICO de Consultas no Médico VÊ HISTÓRICO de Exames no Laboratório

CUIDADO COM O SIGILO DOS DADOS!! Por exemplo, um médico só vê histórico das consultas que ele realizou. Além disso, um paciente só pode ver os seus dados. O campo observação de uma consulta, só pode ser visto pelo médico e não pelo paciente!

Tecnologias: HTML -> Estrutura da Página e Geração de Formulários 
CSS -> Interface Gráfica JavaScript -> Personalização Página e Validação Formulários 
XML -> Armazenamento de dados 
PHP -> Manipulação Dados e Geracão Resultados
