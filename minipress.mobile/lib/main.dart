import 'package:flutter/material.dart';
import 'package:minipress_mobile/mini_press_app.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:provider/provider.dart';

void main() {
  runApp(ChangeNotifierProvider(
      create: (context) => ArticleProvider(), child: const MiniPressApp()));
} 
