<?php

namespace DevelopersNL\Model;

class User
{
    /**
     * // TODO: Some kind of migration for this table
     * TABLE DEF:
     *
     * create table users
     * (
     *  id                     bigint generated always as identity,
     *  firstname              varchar(255),
     *  lastname               varchar(255),
     *  email                  varchar(255) unique,
     *  password               varchar(255),
     *  secret_question        text,
     *  secret_question_answer varchar(255)
     * );
     *
     * @codeCoverageIgnore
     */
    public function __construct(
        public string $firstname,
        public string $lastname,
        readonly public string $email,
        public string $password,
        public string $secretQuestion,
        public string $secretQuestionAnswer,
        public int|null $id = null,
    )
    {
    }
}
