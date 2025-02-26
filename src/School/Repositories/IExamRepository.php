<?php 

namespace App\School\Repositories;

use App\School\Entities\Exams;

interface IExamRepository {
    function getAllExams(): array;
    function findExamById(int $id): ?Exams;
    function save(Exams $exam): bool;
    function deleteExamById(int $id): bool;
}
