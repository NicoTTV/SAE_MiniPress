import 'package:flutter/material.dart';
import './screens/list_articles.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Mini Press',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Page d''accueil'),
        ),
        body: const ListArticles(),
      ),
      debugShowCheckedModeBanner: false,
    );
  }
}