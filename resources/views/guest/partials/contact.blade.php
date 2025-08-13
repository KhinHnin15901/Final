<section class="flex items-center justify-center px-4 sm:px-6 lg:px-8 font-[Arial,sans-serif] max-w-3xl w-full">
    <div class="max-w-4xl w-full bg-white rounded-xl p-8 space-y-6 border-t-4 border-[#027c7d] shadow-md shadow-[#d6dd42]">
        <div class="text-center max-w-xl mx-auto mb-5">
            <h2 class="text-lg font-semibold text-[#000120]">Get in Touch</h2>
            <p class="mt-2 text-sm text-gray-600">Have questions or need support? Fill out the form below, and we'll get back to you.</p>
        </div>
        <div>
            @if (session('success'))
                <div class="mb-5 rounded border border-green-500 bg-green-500/20 text-[#000120] px-4 py-3 font-semibold shadow-sm text-sm">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-[#027c7d] mb-1">Your Name</label>
                    <input
                        type="text" name="name" id="name" required
                        placeholder="Enter your full name"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm"
                    />
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-[#027c7d] mb-1">Your Email</label>
                    <input
                        type="email" name="email" id="email" required
                        placeholder="you@example.com"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm"
                    />
                </div>
                <div>
                    <label for="subject" class="block text-sm font-semibold text-[#027c7d] mb-1">Subject</label>
                    <input
                        type="text" name="subject" id="subject" required
                        placeholder="Subject of your message"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm shadow-sm"
                    />
                </div>
                <div>
                    <label for="message" class="block text-sm font-semibold text-[#027c7d] mb-1">Message</label>
                    <textarea
                        name="message" id="message" rows="5" required
                        placeholder="Write your message here..."
                        class="w-full rounded-md border border-gray-300 px-4 py-2 text-[#000120] placeholder-gray-400
                            focus:outline-none focus:ring-2 focus:ring-[#027c7d] focus:border-[#027c7d] text-sm resize-none shadow-sm"
                    ></textarea>
                </div>
                <div class="text-right">
                    <button
                        type="submit"
                        class="bg-[#027c7d] hover:bg-[#025955] text-white font-semibold px-5 py-2 rounded-md shadow-md transition-transform transform hover:scale-105 text-sm"
                    >
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
