<?php

namespace App\Console\Commands;

use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CheckExpiredExams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-exams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $examUsers = DB::table('exam_user')
            ->whereNotNull('started_at')
            ->whereNull('submitted_at')
            ->get();

        foreach ($examUsers as $examUser) {
            $exam = Exam::find($examUser->exam_id);

            if(!$exam) {
                continue;
            }
            $endTime = Carbon::parse($examUser->started_at)
                ->addMinutes($exam->duration);

            if (now()->greaterThanOrEqualTo($endTime)) {
                $answers = DB::table('exam_answers')
                    ->where('exam_id', $examUser->exam_id)
                    ->where('user_id', $examUser->user_id)
                    ->get();
                $questions = Question::with('options')->where('exam_id',$examUser->exam_id)->get();
                $correct = 0;

                foreach ($questions as $question) {

                    $answer = $answers
                        ->firstWhere('question_id', $question->id);

                    if ($answer &&
                        $question->options
                            ->where('id', $answer->option_id)
                            ->where('is_correct', 1)
                            ->isNotEmpty()
                    ) {
                        $correct += $question->score;
                    }
                }
                $totalScore = $questions->sum('score');

                $score = $totalScore > 0
                    ? ($correct / $totalScore) * 20
                    : 0;

                DB::table('exam_user')
                    ->where('exam_id', $examUser->exam_id)
                    ->where('user_id', $examUser->user_id)
                    ->update([
                        'score' => round($score, 2),
                        'submitted_at' => now(),
                    ]);
            }
        }
        return CommandAlias::SUCCESS;
    }
}
