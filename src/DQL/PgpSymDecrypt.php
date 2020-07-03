<?php

declare(strict_types=1);

namespace ORMBundle\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class PgpSymDecrypt extends FunctionNode
{
    protected $data;

    protected $secret;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf(
            'PGP_SYM_DECRYPT(%s::bytea, %s)',
            $this->data->dispatch($sqlWalker),
            $this->secret->dispatch($sqlWalker)
        );
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->data = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secret = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
