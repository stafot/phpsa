<?php
/**
 * PHP Smart Analysis project 2015-2016
 *
 * @author Patsura Dmitry https://github.com/ovr <talk@dmtry.me>
 */

namespace PHPSA\Compiler\Expression\Operators;

use PHPSA\CompiledExpression;
use PHPSA\Context;
use PHPSA\Compiler\Expression;
use PHPSA\Compiler\Expression\AbstractExpressionCompiler;

class UnaryMinus extends AbstractExpressionCompiler
{
    protected $name = 'PhpParser\Node\Expr\UnaryMinus';

    /**
     * -{expr}
     *
     * @param \PhpParser\Node\Expr\UnaryMinus $expr
     * @param Context $context
     * @return CompiledExpression
     */
    protected function compile($expr, Context $context)
    {
        $left = $context->getExpressionCompiler()->compile($expr->expr);

        switch ($left->getType()) {
            case CompiledExpression::INTEGER:
            case CompiledExpression::DOUBLE:
            case CompiledExpression::NUMBER:
            case CompiledExpression::BOOLEAN:
            case CompiledExpression::STRING:
            case CompiledExpression::NULL:
                return CompiledExpression::fromZvalValue(
                    - (int) $left->getValue()
                );
        }

        return new CompiledExpression();
    }
}
