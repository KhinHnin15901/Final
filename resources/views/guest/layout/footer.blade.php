<footer
    class="bg-white text-gray-700 py-8 mt-10 font-[Arial,sans-serif] shadow-md"
    style="box-shadow: 0 -8px 6px -6px rgba(2,124,125,0.4);"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t-4 border-[#d6dd42] pt-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-sm text-center md:text-left text-[#000120] select-none font-medium">
                &copy;
                <script>document.write(new Date().getFullYear());</script>
                All rights reserved.
            </div>

            <ul class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm font-semibold text-[#000120]">
                <li>
                    <a href="{{ route('guest.home', ['section' => 'contact']) }}" class="relative group hover:text-[#027c7d] transition duration-300">
                        Contact
                        <span
                        class="absolute left-0 -bottom-1 w-full h-0.5 bg-[#d6dd42] scale-x-0 group-hover:scale-x-100 transition-transform origin-left">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
