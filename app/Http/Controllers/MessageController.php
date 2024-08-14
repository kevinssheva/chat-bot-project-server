<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class MessageController extends Controller
{
  public function store(Request $request)
  {
    // Validasi input
    $request->validate([
      'question' => 'required|string',
    ]);

    // Dapatkan jawaban dari OpenAI API
    $answer = $this->getAnswerForQuestion($request->input('question'));

    // Simpan pesan ke database
    $message = Message::create([
      'question' => $request->input('question'),
      'answer' => $answer,
      'createdAt' => now(),
    ]);

    // Kembalikan respons JSON
    return response()->json($message, 201);
  }

  private function getAnswerForQuestion($question)
  {
    try {
      $result = OpenAI::completions()->create([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => $question,
        'max_tokens' => 250,
      ]);

      return $result->choices[0]->text ?? 'No answer available';
    } catch (\Exception $e) {
      Log::error('OpenAI API error: ' . $e->getMessage());
      dd($e->getMessage()); // Dump the error message for debugging
      return 'An error occurred while fetching the answer.';
    }
  }


  public function index()
  {
    // $result = OpenAI::completions()->create([
    //   'model' => 'gpt-3.5-turbo-instruct',
    //   'prompt' => 'do you have any questions?',
    //   'max_tokens' => 250,
    // ]);

    // // Dump the result for debugging
    // dd($result->choices[0]->text);
    $messages = Message::orderBy('createdAt', 'asc')->get();
    return response()->json($messages);
  }
}
