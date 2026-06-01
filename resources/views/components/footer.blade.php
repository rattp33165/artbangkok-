<footer class="bg-black text-white mt-20">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Logo & Description --}}
            <div class="md:col-span-2">
                <img src="{{ asset('images/Logo-art_bangkok-w.png') }}"
                     alt="Art Bangkok"
                     class="h-8 w-auto mb-4">
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    Art Bangkok is Thailand's premier international art fair,
                    bringing together leading galleries and artists from around the world.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">About</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Exhibition Preview</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Visitor Information</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Fair & Event</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Gallery Application</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Ticket</a></li>
                </ul>
            </div>

            {{-- Contact & Social --}}
            <div>
                <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Contact Us</h4>
                <ul class="space-y-2 mb-6">
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Partners</a></li>
                    <li><a href="#" class="text-gray-400 text-sm hover:text-white transition">Contact</a></li>
                </ul>
                <h4 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Follow Us</h4>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Facebook</a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-sm">Instagram</a>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-800 mt-12 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-xs">© 2026 Art Bangkok. All rights reserved.</p>
            <p class="text-gray-500 text-xs">Bangkok, Thailand</p>
        </div>
    </div>
</footer>
