wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/button', 'default');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');
	wp.blocks.unregisterBlockStyle('core/button', 'squared');

});

// Начало костыля, для добавления выделения части текста
'use strict';

var _window$wp$element = window.wp.element;
var createElement = _window$wp$element.createElement;
var Fragment = _window$wp$element.Fragment;
var _window$wp$richText = window.wp.richText;
var registerFormatType = _window$wp$richText.registerFormatType;
var toggleFormat = _window$wp$richText.toggleFormat;
var _window$wp$editor = window.wp.editor;
var RichTextToolbarButton = _window$wp$editor.RichTextToolbarButton;
var RichTextShortcut = _window$wp$editor.RichTextShortcut;


[{
	name: 'has-highlight',
	tag: 'span',
	title: 'Выделение цветом',
	character: '1'
}].forEach(function (_ref) {
	var name = _ref.name;
	var tag = _ref.tag;
	var title = _ref.title;
	var character = _ref.character;
	var icon = _ref.icon;

	var type = 'advanced/' + name;

	registerFormatType(type, {
		title: title,
		tagName: tag,
		className: name,
		edit: function edit(_ref2) {
			var isActive = _ref2.isActive;
			var value = _ref2.value;
			var onChange = _ref2.onChange;

			var onToggle = function onToggle() {
				return onChange(toggleFormat(value, { type: type }));
			};

			return createElement(Fragment, null, createElement(RichTextShortcut, {
				type: 'primary',
				character: character,
				onUse: onToggle
			}), createElement(RichTextToolbarButton, {
				title: title,
				onClick: onToggle,
				isActive: isActive,
				shortcutType: 'primary',
				shortcutCharacter: character,
				className: 'toolbar-button-with-text toolbar-button__advanced-' + name
			}));
		}
	});
});
// Конец костыля, для добавления выделения части текста
