<main class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] w-full">
    <div class="bg-white p-8 rounded-xl shadow-md max-w-4xl mx-auto shadow-[#d6dd42]">
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="text-xl font-bold text-[#000120] mb-1">About Our Platform</h1>
            <div class="w-16 h-1 bg-[#027c7d] mx-auto rounded"></div>
        </div>

        <p class="text-gray-700 text-sm leading-relaxed mb-4">
            Our platform empowers researchers, students, and institutions to discover, submit, and collaborate on
            academic papers and events like conferences and journals.
        </p>

        <p class="text-gray-700 text-sm leading-relaxed mb-4">
            Built with Laravel and integrated with powerful tools like natural language processing (NLP), ECLAT
            algorithm for knowledge discovery, and seamless document handling,
            this system is a bridge between innovation and publication.
        </p>

        <p class="text-gray-700 text-sm leading-relaxed">
            We aim to provide a user-friendly, secure, and modern platform where ideas can be shared, reviewed, and
            published—making knowledge accessible and actionable.
        </p>

        <div class="mt-6">
            <a href="{{ route('guest.home', ['section' => 'events']) }}"
                class="py-2.5 px-6 rounded-md shadow-md text-white bg-[#027c7d] hover:bg-[#026a6b] transition duration-300 text-sm font-semibold">
                Explore Events
            </a>
        </div>
    </div>
</main>
