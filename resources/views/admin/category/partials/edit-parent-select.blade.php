                <select name="parent_id" id="parent_id" class="form-control select2">
                    <option value="0">Main Category</option>
                    @foreach ($getCategories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @if ($cat['subCategories'])
                            @foreach ($cat['subCategories'] as $subCategory)
                                <option value="{{ $subCategory->id }}"
                                    {{ $category->parent_id == $subCategory->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{ $subCategory->name }}</option>
                                @if ($subCategory['subCategories'])
                                    @foreach ($subCategory['subCategories'] as $subCat)
                                        <option value="{{ $subCat->id }}"
                                            {{ $category->parent_id == $subCat->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{ $subCat->name }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
