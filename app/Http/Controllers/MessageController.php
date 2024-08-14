<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
  public function store(Request $request)
  {
    // Validasi input
    $request->validate([
      'question' => 'required|string',
    ]);

    // Simulasi jawaban untuk pertanyaan (misalnya dari AI atau service eksternal)
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
    // Logika untuk mendapatkan jawaban berdasarkan pertanyaan (misalnya dari API eksternal)
    // Untuk simulasi, kita kembalikan jawaban statis
    return "This is a simulated answer for: " . $question;
  }

  public function index()
  {
    $messages = Message::all();
    return response()->json($messages);
  }
}
