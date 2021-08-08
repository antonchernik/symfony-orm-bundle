<?php

declare(strict_types=1);

namespace ORMBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Query\SqlWalker;

class PgpSymEncrypt extends FunctionNode
{
    protected mixed $data;

    protected mixed $secret;

    public function getSql(SqlWalker $sqlWalker): string
    {
        return sprintf(
            'PGP_SYM_ENCRYPT(%s, %s)',
            $this->data->dispatch($sqlWalker),
            $this->secret->dispatch($sqlWalker)
        );
    }

    /**
     * @throws QueryException
     */
    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->data = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secret = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
