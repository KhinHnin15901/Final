<main class="bg-amber-50 min-h-screen py-16">
    <div class="container mx-auto px-4 md:px-12">
        <div class="bg-white p-8 rounded-xl shadow-md max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">About Our Platform</h1>

            <p class="text-gray-700 text-lg leading-relaxed mb-4">
                Our platform empowers researchers, students, and institutions to discover, submit, and collaborate on
                academic papers and events like conferences and journals.
            </p>

            <p class="text-gray-700 text-lg leading-relaxed mb-4">
                Built with Laravel and integrated with powerful tools like natural language processing (NLP), ECLAT
                algorithm for knowledge discovery, and seamless document handling,
                this system is a bridge between innovation and publication.
            </p>

            <p class="text-gray-700 text-lg leading-relaxed">
                We aim to provide a user-friendly, secure, and modern platform where ideas can be shared, reviewed, and
                published—making knowledge accessible and actionable.
            </p>

            <div class="mt-8">
                <a href="{{ route('guest.home', ['section' => 'events']) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Explore Events
                </a>
            </div>
        </div>
    </div>
</main>
