<?php

namespace App\Command;


use App\Components\Dto\User\CreateUserDto;
use App\Components\Exceptions\ApplicationExceptions\Resource\Validation\ValidationException;
use App\Components\Interactors\CRUD\User\CreateUserInteractor;
use App\Entity\User\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'admin:generate';
    private CreateUserInteractor $createUserInteractor;
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        CreateUserInteractor $createUserInteractor,
        string $name = 'admin:generate'
    ) {
        parent::__construct($name);
        $this->createUserInteractor = $createUserInteractor;
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask('Input email');
        $password = $io->ask('Input password');

        $dto = new CreateUserDto(Uuid::uuid4(), $email, $password, 'Europe/Moscow', Admin::class, true);

        try {
            $this->createUserInteractor->call($dto);
            $this->entityManager->flush();
        } catch (ValidationException $validationException) {
            $io->error($validationException->getMessage());
            $io->error($validationException->getInvalidParamsMessage());

            return Command::FAILURE;
        } catch (Throwable $throwable) {
            $io->error($throwable->getMessage() . PHP_EOL . $throwable->getTraceAsString());

            return Command::FAILURE;
        }

        $io->success('Admin was created successful');

        return Command::SUCCESS;
    }
}
