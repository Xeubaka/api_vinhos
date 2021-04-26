<?php
// phpcs:disable PEAR.Commenting
// phpcs:disable Generic.Files.LineLength.TooLong
namespace Util;

abstract class ConstantGenericalUtil
{
    /* Resquests */
    public const TYPE_REQUEST = ['GET', 'POST', 'DELETE', 'PUT'];
    public const GET_TYPE = ['GET'];
    public const POST_TYPE = ['POST'];
    public const DELETE_TYPE = ['DELETE'];
    public const PUT_TYPE = ['PUT'];

    /* Erros */
    public const MSG_ERRO_ROUTE_TYPE = 'Rota não permitida!';
    public const MSG_ERRO_RESOURCE_UNAVAILABLE = 'Recurso inexistente!';
    public const MSG_ERRO_GENERIC = 'Algum erro ocorreu na requisição!';
    public const MSG_ERRO_RETURN_NONE = 'Nenhum registro encontrado!';
    public const MSG_ERRO_NONE_AFFAFFECTED = 'Nenhum registro afetado!';
    public const MSG_ERRO_EMPTY_JSON = 'O corpo da requisição não pode ser vazio!';

    /* Sucesso */
    public const MSG_DELETED_SUCCESSFULLY = 'Registro deletado com Sucesso!';
    public const MSG_UPDATED_SUCCESSFULLY = 'Registro atualizado com Sucesso!';

    /* Recuso Vinhos */
    public const MSG_ERRO_MUST_HAVE_ID = 'ID é obrigatório!';
    public const MSG_ERRO_MISSING_INFORMATION = 'É necessário informar, nome, tipo e peso do Vinho';

    /* Retorno Json */
    const TYPE_SUCCESS = 'sucesso';
    const TYPE_ERROR = 'erro';

    /* OUTRAS */
    public const TYPE = 'tipo';
    public const ANSWER = 'resposta';

}

?>
