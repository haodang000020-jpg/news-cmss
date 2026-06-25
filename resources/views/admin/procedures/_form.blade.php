@php
    $documentRows = $requiredDocumentRows ?: [];
    $procedureStepRows = $stepRows ?: [];
@endphp

<div
    x-data="procedureForm({
        requiredDocuments: @js($documentRows),
        steps: @js($procedureStepRows),
    })"
    x-init="init()"
    class="space-y-6"
>
    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="mb-5 border-b border-gray-200 pb-3">
            <h3 class="text-lg font-semibold text-gray-900">Thông tin chung</h3>
            <p class="mt-1 text-sm text-gray-500">Các thông tin chính sẽ xuất hiện ở trang tra cứu dành cho người dân.</p>
        </div>

        <div class="grid gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Tên thủ tục <span class="text-red-600">*</span></label>
                <input id="name" name="name" type="text" value="{{ old('name', $procedure->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="procedure_group_id" class="block text-sm font-medium text-gray-700">Lĩnh vực <span class="text-red-600">*</span></label>
                    <select id="procedure_group_id" name="procedure_group_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                        <option value="">Chọn lĩnh vực</option>
                        @foreach ($procedureGroups as $procedureGroup)
                            <option value="{{ $procedureGroup->id }}"
                                @selected((string) old('procedure_group_id', $procedure->procedure_group_id) === (string) $procedureGroup->id)>
                                {{ $procedureGroup->name }}{{ $procedureGroup->is_active ? '' : ' (đang ẩn)' }}
                            </option>
                        @endforeach
                    </select>
                    @error('procedure_group_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Mã thủ tục</label>
                    <input id="code" name="code" type="text" value="{{ old('code', $procedure->code) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ví dụ: 1.000894">
                    @error('code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input id="slug" name="slug" type="text" value="{{ old('slug', $procedure->slug) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Tự tạo từ tên nếu để trống">
                    @error('slug')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="summary" class="block text-sm font-medium text-gray-700">Mô tả ngắn</label>
                <textarea id="summary" name="summary" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Tóm tắt mục đích và phạm vi của thủ tục">{{ old('summary', $procedure->summary) }}</textarea>
                @error('summary')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="applicants" class="block text-sm font-medium text-gray-700">Đối tượng thực hiện</label>
                    <input id="applicants" name="applicants" type="text" value="{{ old('applicants', $procedure->applicants) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Cá nhân, tổ chức, hộ gia đình...">
                </div>

                <div>
                    <label for="implementing_agency" class="block text-sm font-medium text-gray-700">Cơ quan thực hiện</label>
                    <input id="implementing_agency" name="implementing_agency" type="text"
                        value="{{ old('implementing_agency', $procedure->implementing_agency) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="UBND xã Vĩnh Bình">
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="receiving_place" class="block text-sm font-medium text-gray-700">Nơi tiếp nhận</label>
                    <textarea id="receiving_place" name="receiving_place" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('receiving_place', $procedure->receiving_place) }}</textarea>
                </div>

                <div>
                    <label for="implementation_method" class="block text-sm font-medium text-gray-700">Cách thức thực hiện</label>
                    <textarea id="implementation_method" name="implementation_method" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Trực tiếp, trực tuyến, qua bưu chính...">{{ old('implementation_method', $procedure->implementation_method) }}</textarea>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="processing_time" class="block text-sm font-medium text-gray-700">Thời hạn giải quyết</label>
                    <input id="processing_time" name="processing_time" type="text"
                        value="{{ old('processing_time', $procedure->processing_time) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ví dụ: Trong ngày làm việc">
                </div>

                <div>
                    <label for="fee" class="block text-sm font-medium text-gray-700">Lệ phí</label>
                    <input id="fee" name="fee" type="text" value="{{ old('fee', $procedure->fee) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Không / 20.000 đồng">
                </div>

                <div>
                    <label for="dossier_quantity" class="block text-sm font-medium text-gray-700">Số lượng hồ sơ</label>
                    <input id="dossier_quantity" name="dossier_quantity" type="text"
                        value="{{ old('dossier_quantity', $procedure->dossier_quantity) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="01 bộ">
                </div>
            </div>

            <div>
                <label for="result" class="block text-sm font-medium text-gray-700">Kết quả thực hiện</label>
                <textarea id="result" name="result" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('result', $procedure->result) }}</textarea>
            </div>

            <div>
                <label for="legal_basis" class="block text-sm font-medium text-gray-700">Căn cứ pháp lý</label>
                <textarea id="legal_basis" name="legal_basis" rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Mỗi văn bản nên nhập trên một dòng">{{ old('legal_basis', $procedure->legal_basis) }}</textarea>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="service_url" class="block text-sm font-medium text-gray-700">Đường dẫn dịch vụ công</label>
                    <input id="service_url" name="service_url" type="url" value="{{ old('service_url', $procedure->service_url) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="https://...">
                    @error('service_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="updated_on" class="block text-sm font-medium text-gray-700">Ngày cập nhật nội dung</label>
                    <input id="updated_on" name="updated_on" type="date"
                        value="{{ old('updated_on', optional($procedure->updated_on)->format('Y-m-d')) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label for="keywords" class="block text-sm font-medium text-gray-700">Từ khóa tìm kiếm</label>
                <textarea id="keywords" name="keywords" rows="2"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Ví dụ: khai sinh, giấy khai sinh, trẻ em mới sinh">{{ old('keywords', $procedure->keywords) }}</textarea>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Thứ tự hiển thị</label>
                    <input id="sort_order" name="sort_order" type="number" min="0"
                        value="{{ old('sort_order', $procedure->sort_order) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="flex items-end pb-2">
                    <input type="hidden" name="is_featured" value="0">
                    <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                        <input name="is_featured" type="checkbox" value="1"
                            @checked(old('is_featured', $procedure->is_featured))
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        Thủ tục nổi bật
                    </label>
                </div>

                <div class="flex items-end pb-2">
                    <input type="hidden" name="is_active" value="0">
                    <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                        <input name="is_active" type="checkbox" value="1"
                            @checked(old('is_active', $procedure->is_active))
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        Hiển thị ngoài website
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between gap-4 border-b border-gray-200 pb-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Thành phần hồ sơ</h3>
                <p class="mt-1 text-sm text-gray-500">Khai báo từng giấy tờ, số bản chính, bản sao và biểu mẫu tải về.</p>
            </div>
            <button type="button" @click="addRequiredDocument()"
                class="rounded-md bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-100">
                + Thêm giấy tờ
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(item, index) in requiredDocuments" :key="item.key">
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <input type="hidden" :name="`required_documents[${index}][id]`" :value="item.id || ''">

                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div class="font-semibold text-gray-800">Giấy tờ <span x-text="index + 1"></span></div>
                        <button type="button" @click="removeRequiredDocument(index)"
                            class="text-sm font-semibold text-red-600 hover:text-red-800">Xóa dòng</button>
                    </div>

                    <div class="grid gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tên giấy tờ <span class="text-red-600">*</span></label>
                            <input type="text" x-model="item.name" :name="`required_documents[${index}][name]`"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>

                        <div class="grid gap-4 md:grid-cols-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bản chính</label>
                                <input type="number" min="0" x-model="item.original_count"
                                    :name="`required_documents[${index}][original_count]`"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bản sao</label>
                                <input type="number" min="0" x-model="item.copy_count"
                                    :name="`required_documents[${index}][copy_count]`"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Thứ tự</label>
                                <input type="number" min="0" x-model="item.sort_order"
                                    :name="`required_documents[${index}][sort_order]`"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex items-end pb-2">
                                <input type="hidden" :name="`required_documents[${index}][is_required]`" value="0">
                                <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                                    <input type="checkbox" value="1" x-model="item.is_required"
                                        :name="`required_documents[${index}][is_required]`"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    Bắt buộc
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ghi chú</label>
                            <textarea rows="2" x-model="item.note" :name="`required_documents[${index}][note]`"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Biểu mẫu đính kèm</label>
                            <input type="file" :name="`required_documents[${index}][form_file]`"
                                accept=".pdf,.doc,.docx,.xls,.xlsx"
                                class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">

                            <template x-if="item.form_name">
                                <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                                    <span>Tệp hiện tại: <strong x-text="item.form_name"></strong></span>
                                    <label class="inline-flex items-center gap-2 text-red-700">
                                        <input type="checkbox" value="1" :name="`required_documents[${index}][remove_form]`"
                                            class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                                        Xóa tệp hiện tại
                                    </label>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        @error('required_documents')
            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('required_documents.*.name')
            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('required_documents.*.form_file')
            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between gap-4 border-b border-gray-200 pb-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Trình tự thực hiện</h3>
                <p class="mt-1 text-sm text-gray-500">Sắp xếp các bước theo thứ tự người dân cần thực hiện.</p>
            </div>
            <button type="button" @click="addStep()"
                class="rounded-md bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-100">
                + Thêm bước
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(step, index) in steps" :key="step.key">
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                    <input type="hidden" :name="`steps[${index}][id]`" :value="step.id || ''">

                    <div class="mb-4 flex items-center justify-between gap-3">
                        <div class="font-semibold text-gray-800">Bước <span x-text="index + 1"></span></div>
                        <button type="button" @click="removeStep(index)"
                            class="text-sm font-semibold text-red-600 hover:text-red-800">Xóa bước</button>
                    </div>

                    <div class="grid gap-4 md:grid-cols-[1fr_140px]">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tên bước <span class="text-red-600">*</span></label>
                            <input type="text" x-model="step.title" :name="`steps[${index}][title]`"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ví dụ: Chuẩn bị hồ sơ" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Thứ tự</label>
                            <input type="number" min="0" x-model="step.sort_order" :name="`steps[${index}][sort_order]`"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Nội dung hướng dẫn</label>
                        <textarea rows="3" x-model="step.description" :name="`steps[${index}][description]`"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                </div>
            </template>
        </div>

        @error('steps')
            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('steps.*.title')
            <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap items-center gap-3 rounded-lg bg-white p-5 shadow-sm">
        <button type="submit"
            class="inline-flex items-center rounded-md bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
            {{ $buttonLabel }}
        </button>
        <a href="{{ route('admin.procedures.index') }}"
            class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            Hủy
        </a>
    </div>
</div>

<script>
    function procedureForm(initialData) {
        return {
            requiredDocuments: Array.isArray(initialData.requiredDocuments)
                ? initialData.requiredDocuments.map((item, index) => ({
                    key: `document-${item.id || 'new'}-${index}-${Date.now()}`,
                    id: item.id || null,
                    name: item.name || '',
                    original_count: item.original_count ?? 0,
                    copy_count: item.copy_count ?? 0,
                    note: item.note || '',
                    is_required: Number(item.is_required ?? 1) === 1 || item.is_required === true,
                    sort_order: item.sort_order ?? index,
                    form_name: item.form_name || '',
                    form_path: item.form_path || '',
                }))
                : [],
            steps: Array.isArray(initialData.steps)
                ? initialData.steps.map((step, index) => ({
                    key: `step-${step.id || 'new'}-${index}-${Date.now()}`,
                    id: step.id || null,
                    title: step.title || '',
                    description: step.description || '',
                    sort_order: step.sort_order ?? index,
                }))
                : [],

            init() {
                if (this.requiredDocuments.length === 0) {
                    this.addRequiredDocument();
                }

                if (this.steps.length === 0) {
                    this.addStep();
                }
            },

            addRequiredDocument() {
                this.requiredDocuments.push({
                    key: `document-new-${Date.now()}-${Math.random()}`,
                    id: null,
                    name: '',
                    original_count: 0,
                    copy_count: 1,
                    note: '',
                    is_required: true,
                    sort_order: this.requiredDocuments.length,
                    form_name: '',
                    form_path: '',
                });
            },

            removeRequiredDocument(index) {
                if (this.requiredDocuments.length === 1) {
                    this.requiredDocuments[0].name = '';
                    this.requiredDocuments[0].note = '';
                    return;
                }

                this.requiredDocuments.splice(index, 1);
            },

            addStep() {
                this.steps.push({
                    key: `step-new-${Date.now()}-${Math.random()}`,
                    id: null,
                    title: '',
                    description: '',
                    sort_order: this.steps.length,
                });
            },

            removeStep(index) {
                if (this.steps.length === 1) {
                    this.steps[0].title = '';
                    this.steps[0].description = '';
                    return;
                }

                this.steps.splice(index, 1);
            },
        };
    }
</script>
