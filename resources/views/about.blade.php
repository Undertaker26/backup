@extends('layouts.layout')

<title>About Us | Scribe Entertainment</title>
<link rel="stylesheet" href="css/about.css">
@section('title', 'About')

@section('content')
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}
.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
<div class="containers">        
        <p>The University Scribe, Urdaneta City University's official student publication, doesn't just disseminate news—it illuminates fresh perspectives toward the goal of student empowerment, development, and art appreciation. Run by skilled student journalists, rigorously trained to deliver nothing but excellence, it serves UCUians with utmost quality.</p>

   
        <div class="org-chart">
            <img src="logo.png" alt="Organizational Chart">
      
        </div>


        <div class="mission">
            <h2>Mission</h2>
            <p>Our mission is to amplify the voices of the student body, especially those overlooked. We strive to empower the students with our articles and artwork to let them be aware of their rights and responsibilities. To provide the mass with unbiased news and thought-provoking articles that broaden their horizons of knowledge, information, and creativity is what we live for.</p>
        </div>
        
        <div class="vision">
            <h2>Vision</h2>
            <p>We envision The University Scribe as a proficient and dynamic student publication, inscribing diverse perspectives into the student community through principled journalism that upholds truth and humanity at its core.</p>
        </div>
    </div>
@endsection