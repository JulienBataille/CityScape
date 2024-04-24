import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap.js';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));