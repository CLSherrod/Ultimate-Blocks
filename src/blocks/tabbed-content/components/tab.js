import '../style.scss';
import '../editor.scss';
import icon from '../icons/icon';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

const { InnerBlocks } = wp.editor;

registerBlockType('ub/tab', {
	title: __('Tab'),
	parent: __('ub/tabbed-content'),
	description: __('content of tab'),
	icon: icon,
	category: 'ultimateblocks',
	attributes: {
		index: {
			type: 'number',
			default: 0
		},
		isActive: {
			type: 'boolean',
			default: true
		}
	},
	supports: {
		inserter: false,
		reusable: false
	},
	edit(props) {
		return (
			<div
				style={{
					display: props.attributes.isActive ? 'block' : 'none'
				}}
			>
				<InnerBlocks templateLock={false} />
			</div>
		);
	},
	save(props) {
		return (
			<div
				className={`wp-block-ub-tabbed-content-tab-content-wrap ${
					props.attributes.isActive ? 'active' : 'ub-hide'
				}`}
			>
				<InnerBlocks.Content />
			</div>
		);
	}
});
