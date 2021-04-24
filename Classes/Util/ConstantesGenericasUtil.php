<?php

namespace Util;

abstract class ConstantesGenericasUtil
{
    /* Resquests */
    public const TIPO_REQUEST = ['GET', 'POST', 'DELETE', 'PUT'];
    public const TIPO_GET = ['GET'];
    public const TIPO_POST = ['POST'];
    public const TIPO_DELETE = ['DELETE'];
    public const TIPO_PUT = ['PUT'];

    /* Erros */
    public const MSG_ERRO_TIPO_ROTA = 'Rota não permitida!';
    public const MSG_ERRO_RECURSO_INEXISTENTE = 'Recurso inexistente!';
    public const MSG_ERRO_GENERICO = 'Algum erro ocorreu na requisição!';
    public const MSG_ERRO_SEM_RETORNO = 'Nenhum registro encontrado!';
    public const MSG_ERRO_NAO_AFETADO = 'Nenhum registro afetado!';
    public const MSG_ERRO_TOKEN_VAZIO = 'É necessário informar um Token!';
    public const MSG_ERRO_TOKEN_NAO_AUTORIZADO = 'Token não autorizado!';
    public const MSG_ERRO_JSON_VAZIO = 'O corpo da requisição não pode ser vazio!';
    public const MSG_ERRO_QUANTIDADE_NULA = 'Quantidade não pode ser zero!';
    public const MSG_ERRO_QUANTIDADE_NEGATIVA = 'Quantidade não pode ser negativa!';

    /* Sucesso */
    public const MSG_DELETADO_SUCESSO = 'Registro deletado com Sucesso!';
    public const MSG_ATUALIZADO_SUCESSO = 'Registro atualizado com Sucesso!';

    /* Recuso Vinhos */
    public const MSG_ERRO_ID_OBRIGATORIO = 'ID é obrigatório!';
    public const MSG_ERRO_NOME_OBRIGATORIO = 'Nome é obrigatório!';
    public const MSG_ERRO_TIPO_OBRIGATORIO = 'Tipo é obrigatório!';
    public const MSG_ERRO_PESO_OBRIGATORIO = 'Peso é obrigatório!';
    public const MSG_ERRO_INFORMACOES_OBRIGATORIAS = 'É necessário informar, nome, tipo e peso do Vinho';

    /* Retorno Json */
    const TIPO_SUCESSO = 'sucesso';
    const TIPO_ERRO = 'erro';

    /* OUTRAS */
    public const DISTANCIA = 'KM';
    public const TIPO = 'tipo';
    public const RESPOSTA = 'resposta';

}

?>