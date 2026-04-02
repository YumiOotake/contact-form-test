@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
@endsection
@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h1 class="heading-title admin__heading-title">Admin</h1>
        </div>
        <form class="search-form" action="{{ route('search') }}" method="get">
            <div class="search-form__item">
                <input type="text" name="keyword" class="search-form__item-input" placeholder="名前やメールアドレスを入力してください "
                    value="{{ request('keyword') }}">
            </div>
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <select name="gender" class="search-form__item-input search-form__select">
                        <option value="">性別</option>
                        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
            </div>
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <select name="category_id" class="search-form__item-input search-form__select">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $index => $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $index + 1 }}. {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="search-form__item">
                <div class="search-form__select-wrapper">
                    <input type="date" id="date" name="date"
                        class="search-form__item-input search-form__item--select" placeholder="年/月/日"
                        value="{{ request('date') }}">
                </div>
            </div>
            <div class="search-form__button">
                <button class="search-form__button--submit" type="submit">検索</button>
                <a href="{{ route('reset') }}" class="search-form__button--reset">
                    リセット
                </a>
            </div>
        </form>
        <div class="admin-content__nav">
            <div class="admin-content__export">
                <a href="{{ route('export', request()->query()) }}" class="admin-content__export--button">エクスポート</a>
            </div>
            <div class="admin-content__paginate">
                {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>


        {{-- <div class="contact-table"> --}}
        <table class="contact-table">
            <thead class="contact-table__thead">
                <tr class="contact-table__row">
                    <th class="contact-table__header">お名前</th>
                    <th class="contact-table__header">性別</th>
                    <th class="contact-table__header">メールアドレス</th>
                    <th class="contact-table__header">お問い合わせの種類</th>
                    <th class="contact-table__header"></th>
                </tr>
            </thead>
            <tbody class="contact-table__tbody">
                @forelse ($contacts as $contact)
                    <tr class="contact-table__row">
                        <td class="contact-table__item">{{ $contact->full_name }}</td>
                        <td class="contact-table__item">{{ $contact->gender_label }}</td>
                        <td class="contact-table__item">{{ $contact->email }}</td>
                        <td class="contact-table__item">{{ $contact->category->content }}</td>
                        <td class="contact-table__item">
                            <div class="contact-table__detail">
                                <a class="js-modal-open contact-table__detail-button" data-id="{{ $contact->id }}">詳細</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="contact-table__empty">
                            お問い合わせがありません。
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @forelse ($contacts as $contact)
        <dialog id="modal-{{ $contact->id }}" class="modal">
            <button class="js-modal-close modal__close">×</button>
            <div class="modal__inner">
                <table class="modal__table">
                    <tr class="modal__table-row">
                        <th class="modal__table-title">お名前</th>
                        <td class="modal__table-data">{{ $contact->full_name }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">性別</th>
                        <td class="modal__table-data">{{ $contact->gender_label }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">メールアドレス</th>
                        <td class="modal__table-data">{{ $contact->email }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">電話番号</th>
                        <td class="modal__table-data">{{ $contact->tel }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">住所</th>
                        <td class="modal__table-data">{{ $contact->address }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">建物名</th>
                        <td class="modal__table-data">{{ $contact->building }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">お問い合わせの種類</th>
                        <td class="modal__table-data">{{ $contact->category->content }}</td>
                    </tr>
                    <tr class="modal__table-row">
                        <th class="modal__table-title">お問い合わせ内容</th>
                        <td class="modal__table-data">{{ $contact->detail }}</td>
                    </tr>
                </table>
                <form action="{{ route('delete', $contact) }}" method="POST" class="modal__button">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal__button--delete">
                        削除
                    </button>
                </form>
            </div>
        </dialog>
    @empty
    @endforelse

    {{-- </div> --}}
    @push('scripts')
        <script>
            document.querySelectorAll('.js-modal-open').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const modal = document.querySelector(`#modal-${id}`);
                    modal.showModal();
                });
            });

            document.querySelectorAll('.js-modal-close').forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.closest('dialog').close();
                });
            });
        </script>
    @endpush
@endsection
