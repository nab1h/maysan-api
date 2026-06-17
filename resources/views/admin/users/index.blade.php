<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">إدارة المستخدمين</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
            @endif

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900">سجل المستخدمين والصلاحيات</h3>
            </div>

            <div x-data="userManager()" x-init="{{ $errors->any() ? 'showModal = true' : '' }}">

                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-gray-50 text-gray-500 text-xs uppercase border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-start">#ID</th>
                                    <th class="px-6 py-4 text-start">الاسم</th>
                                    <th class="px-6 py-4 text-start">البريد الإلكتروني</th>
                                    <th class="px-6 py-4 text-start">الصلاحية</th>
                                    <th class="px-6 py-4 text-start">الفرع</th>
                                    <th class="px-6 py-4 text-center">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-mono text-xs text-gray-400">#{{ $user->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                        $roleClasses = [
                                        'admin' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'branch_reception' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'user' => 'bg-gray-50 text-gray-700 border-gray-200',
                                        ];
                                        $roleNames = ['admin' => 'أدمن', 'sales' => 'استقبال فرع', 'user' => 'يوزر'];
                                        @endphp
                                        <span class="px-3 py-1 text-xs rounded-full border {{ $roleClasses[$user->role] ?? $roleClasses['user'] }}">
                                            {{ $roleNames[$user->role] ?? $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $user->branch->name ?? 'كل الفروع' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- تم تغيير طريقة تمرير البيانات لـ JSON -->
                                            <button @click="openEditModal($event)"
                                                data-user="{{ $user->toJson() }}"
                                                class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition" title="تعديل">
                                                <i class="fas fa-pen text-xs"></i>
                                            </button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-600 hover:bg-red-600 hover:text-white transition" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-gray-200 text-gray-600 text-sm bg-gray-50/50">
                        {{ $users->links() }}
                    </div>
                </div>

                <!-- ===== EDIT USER MODAL ===== -->
                <div x-show="showModal" class="fixed inset-0 bg-brand-900/60 backdrop-blur-sm z-50" @click="showModal = false" style="display: none;"></div>

                <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">

                    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative" @click.stop>
                        <button @click="showModal = false" class="absolute top-4 left-4 text-gray-400 hover:text-red-500 transition z-10">
                            <i class="fas fa-times text-xl"></i>
                        </button>

                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-brand-900 mb-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                                تعديل المستخدم: <span x-text="editName" class="text-gold-400"></span>
                            </h2>

                            <!-- عرض أخطاء الـ Validation داخل النافذة -->
                            @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-6">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- فورم تعديل البيانات -->
                            <form id="editForm" action="#" method="POST">
                                @csrf @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">الاسم</label>
                                        <input type="text" name="name" x-model="editName" required class="w-full border border-gray-300 rounded-xl p-2.5 focus:ring-[#135158] focus:border-[#135158]">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">البريد الإلكتروني</label>
                                        <input type="email" name="email" x-model="editEmail" required class="w-full border border-gray-300 rounded-xl p-2.5 focus:ring-[#135158] focus:border-[#135158]">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">الصلاحية</label>
                                        <select name="role" x-model="editRole" required class="w-full border border-gray-300 rounded-xl p-2.5 focus:ring-[#135158] focus:border-[#135158]">
                                            <option value="admin">أدمن (Admin)</option>
                                            <option value="sales">استقبال فرع</option>
                                            <option value="user">يوزر (User)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">الفرع التابع له</label>
                                        <select name="branch_id" x-model="editBranchId" class="w-full border border-gray-300 rounded-xl p-2.5 focus:ring-[#135158] focus:border-[#135158]">
                                            <option value="">-- بدون فرع --</option>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-[#135158] text-white font-bold py-3 rounded-xl hover:bg-[#1a6b73] transition shadow-md">
                                    حفظ التعديلات
                                </button>
                            </form>

                            <!-- فاصل -->
                            <div class="relative my-8">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center"><span class="bg-white px-4 text-sm text-gray-400">أو تغيير كلمة المرور</span></div>
                            </div>

                            <!-- فورم تغيير كلمة المرور -->
                            <form id="passwordForm" action="#" method="POST">
                                @csrf @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">كلمة المرور الجديدة</label>
                                        <input type="password" name="password" required class="w-full border border-yellow-300 rounded-xl p-2.5 focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">تأكيد كلمة المرور</label>
                                        <input type="password" name="password_confirmation" required class="w-full border border-yellow-300 rounded-xl p-2.5 focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-yellow-500 text-white font-bold py-3 rounded-xl hover:bg-yellow-600 transition shadow-md">
                                    تغيير كلمة المرور فقط
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- كود Alpine.js المحسن -->
    <script>
        function userManager() {
            return {
                showModal: false,
                editId: '',
                editName: '',
                editEmail: '',
                editRole: '',
                editBranchId: '',

                openEditModal(event) {
                    // استخراج بيانات المستخدم من data-user كـ JSON
                    const user = JSON.parse(event.currentTarget.dataset.user);

                    this.editId = user.id;
                    this.editName = user.name;
                    this.editEmail = user.email;
                    this.editRole = user.role;
                    this.editBranchId = user.branch_id ? String(user.branch_id) : '';
                    this.showModal = true;

                    // تحديث مسار الفورمين ديناميكياً بعد ملء البيانات
                    this.$nextTick(() => {
                        document.getElementById('editForm').action = '/users/' + this.editId;
                        document.getElementById('passwordForm').action = '/users/' + this.editId + '/password';
                    });
                }
            }
        }
    </script>

</x-app-layout>
